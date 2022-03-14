<template>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse show" style="">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <Link class="nav-link active" aria-current="page" :href="`${$page.props.url}admin`">
              <span data-feather="home"></span>
              Dashboard
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/products`">
              <span data-feather="shopping-cart"></span>
              Products
            </Link> 
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/categories`">
              <span data-feather="file"></span>
              Categories
            </Link> 
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/users`">
              <span data-feather="users"></span>
              Customers
            </Link> 
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/reports`">
              <span data-feather="bar-chart-2"></span>
              Reports
            </Link> 
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <Link class="link-secondary" :href="`${$page.props.url}admin`" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </Link> 
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/home-sliders`">
              <span data-feather="file-text"></span>
              Home Sliders
            </Link> 
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/on-sale`">
              <span data-feather="file-text"></span>
              On Sale
            </Link> 
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin/home-categories`">
              <span data-feather="file-text"></span>
              Home Categories
            </Link> 
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="`${$page.props.url}admin`">
              <span data-feather="file-text"></span>
              Social engagement
            </Link> 
          </li>
        </ul>
      </div>
    </nav><!--end sidebar-->
</template>