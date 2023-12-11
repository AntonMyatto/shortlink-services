<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateLinkRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::all();

        return view('admin.generate-links.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('title', 'id');

        return view('admin.generate-links.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenerateLinkRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $filePath = Storage::disk('public')->put('images/generate-links', request()->file('img'));
            $validated['img'] = $filePath;
        }

        $tags_id = $request->tags;

        $create = Course::create($validated);

        $create->tags()->attach($tags_id);

        if ($create) {
            session()->flash('success', 'Курс успешно создан');
            return redirect()->route('generate-links.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $tags = $course->tags;

        return view('admin.generate-links.show',compact('course','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $tags = Tag::all();

        $levels = ['beginner'=>'Начинающий','middle'=>'Средний','profi'=>'Профи'];

        return view('admin.generate-links.edit', compact('course','tags','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published' => 'required',
            'content' => 'required',
            'is_premium' => 'required',
            'level' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            Storage::disk('public')->delete($course->img);
            $filePath = Storage::disk('public')->put('images/generate-links', request()->file('img'), 'public');
            $data['img'] = $filePath;
        }

        $update = $course->update($data);

        $tags_id = $request->tags;

        $course->tags()->sync($tags_id);

        if ($update) {
            session()->flash('success', 'Курс успешно обновлен!');
            return redirect()->route('generate-links.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id): RedirectResponse
    {
        $course = Course::find($id);

        Storage::disk('public')->delete($course->img);

        $delete = $course->delete($id);

        if ($delete) {
            session()->flash('delete', 'Курс успешно удален!');
            return redirect()->route('generate-links.index');
        }

        return abort(500);
    }
}
