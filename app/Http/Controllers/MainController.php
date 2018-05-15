<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\StoryModel;
use App\ProfileModel;
use App\TagModel;
use App\ImageModel;
use App\FollowModel;
use App\BookmarkModel;

class MainController extends Controller
{
    function index()
    {
        if (Auth::id()) {
            $id = Auth::id();
            $profile = FollowModel::GetAllFollowing($id);
            $topStory = StoryModel::PagTimelinesStory(20, $profile, $id);
            return view('home.index', [
                'title' => 'Official Site',
                'path' => 'home',
                'topStory' => $topStory
            ]);
        } else {
            return view('home.home', [
                'title' => 'Official Site',
                'path' => 'home'
            ]);
        }
    }
    function collections()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagAllStory(20);
        $topTags = TagModel::TopTags();
        $allTags = TagModel::AllTags();
        $topUsers = ProfileModel::TopUsers($id, 7);
        return view('collections.index', [
            'title' => 'Collections',
            'path' => 'collections',
            'topStory' => $topStory,
            'topTags' => $topTags,
            'allTags' => $allTags,
            'topUsers' => $topUsers
        ]);
    }
    function collectionsId($ctr)
    {
        return view('others.index', ['title' => 'Collections', 'path' => 'collections']);
    }
    function tagsId($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagTagStory($ctr, 20);
        return view('others.index', [
            'title' => $ctr,
            'path' => 'category',
            'topStory' => $topStory
        ]);
    }
    function ctrId($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagCtrStory($ctr, 20);
        return view('others.index', [
            'title' => 'Category',
            'path' => 'category',
            'topStory' => $topStory
        ]);
    }
    function ctr()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $allTags = TagModel::AllTags();
        $topUsers = ProfileModel::TopUsers($id, 8);
        $topTags = TagModel::TopSmallTags();
        return view('main.category', [
            'title' => 'Categories ',
            'path' => 'category',
            'topUsers' => $topUsers,
            'topTags' => $topTags,
            'allTags' => $allTags
        ]);
    }
    function timelines()
    {
        $id = Auth::id();
        $profile = FollowModel::GetAllFollowing($id);
        $topStory = StoryModel::PagTimelinesStory(20, $profile);
        return view('others.index', [
            'title' => 'Timelines',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagPopularStory(20);
        return view('others.index', [
            'title' => 'Popular',
            'path' => 'category',
            'topStory' => $topStory
        ]);
    }
    function fresh()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagAllStory(20);
        return view('others.index', [
            'title' => 'Fresh',
            'path' => 'category',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagTrendingStory(20);
        return view('others.index', [
            'title' => 'Trending',
            'path' => 'category',
            'topStory' => $topStory
        ]);
    }
    function search($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagSearchStory($ctr, 20);
        $topUsers = ProfileModel::SearchUsers($ctr, $id);
        $topTags = TagModel::SearchTags($ctr);
        return view('search.index', [
            'title' => $ctr,
            'path' => 'home-search',
            'topStory' => $topStory,
            'topUsers' => $topUsers,
            'topTags' => $topTags
        ]);
    }
    function searchNormal()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $ctr = $_GET['q'];
        $topStory = StoryModel::PagSearchStory($ctr, 20);
        $topUsers = ProfileModel::SearchUsers($ctr, $id);
        $topTags = TagModel::SearchTags($ctr);
        return view('search.index', [
            'title' => $ctr,
            'path' => 'home-search',
            'topStory' => $topStory,
            'topUsers' => $topUsers,
            'topTags' => $topTags
        ]);
    }
    function composeStory()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        return view('compose.story', [
            'title' => 'New Story',
            'path' => 'compose'
        ]);
    }
    function login()
    {
        return view('sign.in', ['title' => 'Login', 'path' => 'none']);
    }
    function signup()
    {
        return view('sign.up', ['title' => 'Signup', 'path' => 'none']);
    }
}
