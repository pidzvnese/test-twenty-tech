<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Blog Example</h3>
        <strong>BE</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#postSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-copy"></i>
                Posts
            </a>
            <ul class="collapse list-unstyled" id="postSubmenu">
                <li>
                    <a href="#">All posts</a>
                </li>
                <li>
                    <a href="#">Add post</a>
                </li>
            </ul>
        </li>

    </ul>
    <ul class="list-unstyled CTAs">
        <li>
            <a class="download" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
