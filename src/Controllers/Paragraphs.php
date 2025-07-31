<?php
namespace Michalsn\CodeIgniterHtmxDemo\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Method;
use Michalsn\CodeIgniterHtmxDemo\Models\ParagraphModel;
use ReflectionException;

class Paragraphs extends BaseController
{
    /**
     * Display paragraphs list.
     */
    public function index(): string
    {
        helper('form');

        $model = model(ParagraphModel::class);
        $data  = [
            'paragraphs' => $model->orderBy('sort', 'asc')
            ->findAll(),
        ];

        if ($this->request->isHtmx() && ! $this->request->isBoosted()) {
            return view_fragment('Michalsn\CodeIgniterHtmxDemo\Views\paragraphs\index', 'paragraphs', $data);
        }

        return view('Michalsn\CodeIgniterHtmxDemo\Views\paragraphs\index', $data);
    }

    /**
     * Edit paragraph
     */
    public function edit(int $id): string
    {
        $model = model(ParagraphModel::class);

        if (! $paragraph = $model->find($id)) {
            throw new PageNotFoundException('Incorrect paragraph id.');
        }

        helper([ 'form', 'alert' ]);

        $validation = service('validation');

        if ($this->request->getMethod() !== Method::POST) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\paragraphs\edit', [
                'paragraph'  => $paragraph,
                'validation' => $validation,
            ]);
        }

        $post = $this->request->getPost([ 'title', 'body' ]);

        $validation->setRules([
            'title' => [ 'required', 'string', 'min_length[5]', 'max_length[64]' ],
            'body'  => [ 'required', 'string', 'min_length[20]', 'max_length[255]' ],
        ])
        ;

        if (! $validation->run($post)) {
            $this->response->setReswap('innerHTML')
                ->setRetarget('#modal-fields')
            ;
            return view_fragment('Michalsn\CodeIgniterHtmxDemo\Views\paragraphs\edit', 'fields', [
                'paragraph'  => $paragraph,
                'validation' => $validation,
            ]).alert('danger', 'Form validation failed.');
        }

        $model->update($paragraph->id, $post);

        $this->response->triggerClientEvent('closeModal');

        return $this->index().alert('success', 'Paragraph was updated.');
    }

    /**
     * Reorder paragraphs
     *
     * @throws ReflectionException
     */
    public function reorder(): string
    {
        $ids = array_map('intval', $this->request->getPost('ids') ?? []);

        if (empty($ids)) {
            throw new PageNotFoundException('Missing paragraph IDs.');
        }

        helper('alert');

        $model = model(ParagraphModel::class);

        $count = $model->whereIn('id', $ids)
            ->countAllResults()
        ;

        if ($count !== count($ids)) {
            return alert('danger', 'Incorrect number of paragraphs.');
        }

        $data = [];

        foreach ($ids as $key => $id) {
            $data[] = [
                'id'   => $id,
                'sort' => $key + 1
            ];
        }

        $model->updateBatch($data, 'id');

        return $this->index().alert('success', 'The order of paragraphs has been changed.');
    }
}
