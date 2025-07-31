<?php
namespace Michalsn\CodeIgniterHtmxDemo\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Method;
use InvalidArgumentException;
use Michalsn\CodeIgniterHtmxDemo\Models\BookModel;
use Michalsn\CodeIgniterHtmxDemo\TableHelper;

class Books extends BaseController
{
    /**
     * Base URL.
     */
    protected string $baseURL = 'books';

    /**
     * Display table.
     */
    public function index(): string
    {
        $data = [
            'limit'         => $this->request->getGet('limit') ?? 5,
            'page'          => $this->request->getGet('page') ?? 1,
            'search'        => $this->request->getGet('search') ?? '',
            'sortColumn'    => $this->request->getGet('sortColumn') ?? 'id',
            'sortDirection' => $this->request->getGet('sortDirection') ?? 'asc',
        ];

        $rules = [
            'limit'         => [ 'is_natural_no_zero', 'less_than_equal_to[10]' ],
            'page'          => [ 'is_natural', 'greater_than_equal_to[1]' ],
            'search'        => [ 'string' ],
            'sortColumn'    => [ 'in_list[id,title,author]' ],
            'sortDirection' => [ 'in_list[asc,desc]' ],
        ];

        if (! $this->validateData($data, $rules)) {
            throw new InvalidArgumentException(implode(PHP_EOL, $this->validator->getErrors()));
        }

        helper('form');

        $model = model(BookModel::class);

        $data['books'] = $model
            ->when($data['search'] !== '', function ($query) use ($data) {
                return $query
                    ->like('title', $data['search'], 'both')
                    ->orLike('author', $data['search'], 'both')
                ;
            })
            ->orderBy($data['sortColumn'], $data['sortDirection'])
            ->paginate((int) $data['limit'], 'default', (int) $data['page'])
        ;

        $data['pager'] = $model->pager->setPath($this->baseURL);
        $data['table'] = new TableHelper($this->baseURL, $data['sortColumn'], $data['sortDirection']);

        if ($this->request->isHtmx() && ! $this->request->isBoosted()) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table', $data);
        }

        return view('Michalsn\CodeIgniterHtmxDemo\Views\books\index', $data);
    }

    /**
     * Edit row.
     */
    public function edit(int $id): string
    {
        $model = model(BookModel::class);

        if (! $book = $model->find($id)) {
            throw new PageNotFoundException('Incorrect book id.');
        }

        helper([ 'form', 'alert' ]);

        $validation = service('validation');

        if ($this->request->getMethod() !== Method::POST) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row_edit', [
                'book'       => $book,
                'validation' => $validation,
            ]);
        }

        $post = $this->request->getPost([ 'title', 'author' ]);

        $validation->setRules([
            'title'  => [ 'required', 'string', 'min_length[2]', 'max_length[100]' ],
            'author' => [ 'required', 'string', 'min_length[5]', 'max_length[100]' ],
        ])
        ;

        if (! $validation->run($post)) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row_edit', [
                'book'       => $book,
                'validation' => $validation,
            ]).alert('danger', 'Form validation failed.');
        }

        $model->update($book->id, $post);

        $book = (object) array_merge((array) $book, $post);

        return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row', [
            'book' => $book,
        ]).alert('success', 'Book was updated.');
    }

    /**
     * Add row.
     */
    public function add(): string
    {
        $model = model(BookModel::class);

        helper([ 'form', 'alert' ]);

        $validation = service('validation');

        if ($this->request->getMethod() !== Method::POST) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row_add', [
                'validation' => $validation,
            ]);
        }

        $post = $this->request->getPost([ 'title', 'author' ]);

        $validation->setRules([
            'title'  => [ 'required', 'string', 'min_length[2]', 'max_length[100]' ],
            'author' => [ 'required', 'string', 'min_length[5]', 'max_length[100]' ],
        ])
        ;

        if (! $validation->run($post)) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row_add', [
                'validation' => $validation,
            ]).alert('danger', 'Form validation failed.');
        }

        if ($id = $model->insert($post)) {
            return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row', [
                'book' => $model->find($id),
            ]).alert('success', 'The book was added successfully.');
        }

        return alert('danger', 'Adding a book failed.');
    }

    /**
     * Show row.
     */
    public function show(int $id): string
    {
        if (! $book = model(BookModel::class)->find($id)) {
            throw new PageNotFoundException('Incorrect book ID.');
        }

        return view('Michalsn\CodeIgniterHtmxDemo\Views\books\table_row', [
            'book'       => $book,
            'validation' => service('validation'),
        ]);
    }

    /**
     * Delete row.
     */
    public function delete(int $id): string
    {
        helper('alert');

        if (model(BookModel::class)->delete($id)) {
            return alert('success', 'The book has been deleted.');
        }

        return alert('danger', 'Deleting the book failed, or the book does not exist.');
    }
}
