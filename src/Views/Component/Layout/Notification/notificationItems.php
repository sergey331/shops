@if(!empty($notifications))
    <a class="dropdown-item py-3 border-bottom">
        <p class="mb-0 fw-medium float-start">You have {{ count($notifications) }} new notifications </p>
        <span class="badge badge-pill badge-primary float-end">View all</span>
    </a>
    @foreach($notifications as $notification)
        <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
                <i class="mdi mdi-package-variant m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
                <h6 class="preview-subject fw-normal text-dark mb-1">{{ $notification->title }}</h6>
                <p class="fw-light small-text mb-0"> {{ timeAgo($notification->created_at) }}</p>
            </div>
        </a>
    @endforeach
@else
    <a class="dropdown-item preview-item py-3">
        <div class="preview-item-content">
            <h6 class="preview-subject fw-normal text-dark mb-1">You dont have a notification</h6>
        </div>
    </a>
@endif

