<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateLinkRequest;
use App\Models\Generatelink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenerateLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $links = Generatelink::latest()->get();

        return view('admin.generate-links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.generate-links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenerateLinkRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = Generatelink::create($validated);

        if ($create) {
            session()->flash('success', 'Ссылка успешно сокращена');
            return redirect()->route('generate-links.index');
        }

        return abort(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $link = Generatelink::find($id);
        return view('admin.generate-links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = [
            "generated" => $request->generated,
            "link" => $request->link,
        ];

        Generatelink::where('id', $id)->update($update);

        if ($update) {
            session()->flash('success', 'Ссылка успешно сокращена');
            return redirect()->route('generate-links.index');
        }

        return abort(500);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGeneratedLink($generated)
    {
        $generatedLink = Generatelink::where('generated', $generated)->first();
        $generatedLink->count++;
        $generatedLink->save();

        return redirect($generatedLink->link);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id): RedirectResponse
    {
        $link = Generatelink::find($id);

        $delete = $link->delete($id);

        if ($delete) {
            session()->flash('delete', 'Ссылка успешно удалена!');
            return redirect()->route('generate-links.index');
        }

        return abort(500);
    }
}
