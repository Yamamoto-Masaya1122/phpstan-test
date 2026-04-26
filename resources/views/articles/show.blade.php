@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $article->title }}</h1>
        <p class="text-gray-400 text-sm mb-6">{{ $article->created_at->format('Y/m/d') }}</p>
        <div class="text-gray-700 leading-relaxed mb-8 whitespace-pre-wrap">{{ $article->body }}</div>

        <div class="flex gap-3">
            <a href="{{ route('articles.edit', $article) }}"
               class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded transition">
                編集
            </a>
            <form action="{{ route('articles.destroy', $article) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('削除しますか？')"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                    削除
                </button>
            </form>
            <a href="{{ route('articles.index') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded transition">
                一覧に戻る
            </a>
        </div>
    </div>
@endsection