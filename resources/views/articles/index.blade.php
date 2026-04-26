@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">記事一覧</h1>
        <a href="{{ route('articles.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
            新規作成
        </a>
    </div>

    @forelse ($articles as $article)
        <div class="bg-white rounded-lg shadow p-6 mb-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $article->title }}</h2>
            <p class="text-gray-500 text-sm mb-4">{{ $article->created_at->format('Y/m/d') }}</p>
            <div class="flex gap-2">
                <a href="{{ route('articles.show', $article) }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded text-sm transition">
                    詳細
                </a>
                <a href="{{ route('articles.edit', $article) }}"
                   class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded text-sm transition">
                    編集
                </a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('削除しますか？')"
                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded text-sm transition">
                        削除
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
            記事がありません
        </div>
    @endforelse
@endsection