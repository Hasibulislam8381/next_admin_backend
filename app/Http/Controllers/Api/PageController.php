<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use App\Notifications\NewPageCreated;

class PageController extends Controller
{
    use ApiResponse;

    // LIST all pages
    public function index()
    {
        $pages = Page::latest()->paginate(10);

        return $this->success($pages, 'Pages fetched successfully');
    }

    // CREATE new page
    public function store(PageRequest $request)
    {
        $slug = $this->generateUniqueSlug($request->title);

        $page = Page::create([
            'title'        => $request->title,
            'slug'         => $slug,
            'page_content' => $request->page_content,
            'status'       => $request->status ?? 'published',
        ]);
        $request->user()->notify(new NewPageCreated($page));

        return $this->success($page, 'Page created successfully', 201);
    }

    // SHOW single page
    public function show(Page $page)
    {
        return $this->success($page, 'Page fetched successfully');
    }

    // UPDATE page
    public function update(PageRequest $request, Page $page)
    {
        $data = [
            'title'        => $request->title,
            'page_content' => $request->page_content,
            'status'       => $request->status ?? $page->status,
        ];

        // Title change hole slug o notun kore generate hobe (nijer id bad diye unique check)
        if ($request->title !== $page->title) {
            $data['slug'] = $this->generateUniqueSlug($request->title, $page->id);
        }

        $page->update($data);

        return $this->success($page->fresh(), 'Page updated successfully');
    }

    // DELETE page
    public function destroy($id)
    {
        $page = Page::find($id);

        if (!$page) {
            return $this->error(null, 'Page not found', 404);
        }

        $page->delete();

        return $this->success(null, 'Page deleted successfully');
    }
    /**
     * Title theke unique slug generate kora.
     * Same title dile: about-us, about-us-1, about-us-2...
     */
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        $query = Page::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;

            $query = Page::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }
}
