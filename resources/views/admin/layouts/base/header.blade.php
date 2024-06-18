<div class="be-header">
    <div class="btn btn-light be-header-icon" id="beHeaderBtn">
        <i class='bx bx-menu'></i>
    </div>
    <div class="be-header-options">

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='bx bxs-user-circle'></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="ri-user-line"></i>My
                        Account</a></li>
                <li><a class="dropdown-item" href="#"><i class="ri-notification-line"></i>Notification</a></li>
                <li><a class="dropdown-item" href="#"><i class="ri-chat-2-line"></i>Message</a></li>
                <li><a class="dropdown-item" href="#"><i class="ri-settings-4-line"></i>Settings</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                            class="ri-shut-down-line"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</div>
