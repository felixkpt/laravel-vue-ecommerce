<template>
  <nav
      id="sidebarMenu"
      class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse show"
      style=""
  >
      <div class="position-sticky pt-3">
          <ul class="nav flex-column">
              <li class="nav-item">
                  <Link
                      class="nav-link active"
                      aria-current="page"
                      :href="`${$page.props.url}admin`"
                  >
                      <i class="fas fa-home"></i>
                      Dashboard
                  </Link>
              </li>
              <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/products`"
                  >
                      <i class="fas fa-shopping-cart"></i>
                      Products
                  </Link>
              </li>
              <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/categories`"
                  >
                      <i class="fas fa-list"></i>
                      Categories
                  </Link>
              </li>
              <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/orders`"
                  >
                      <i class="fas fa-box"></i>
                      Orders
                  </Link>
              </li>
               <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/users`"
                  >
                      <i class="fas fa-users"></i>
                      Users
                  </Link>
              </li>
          </ul>

          <h6
              class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"
          >
              <span>Home Settings</span>
              <Link
                  class="link-secondary"
                  :href="`${$page.props.url}admin`"
                  aria-label="Add a new report"
              >
                  <i class="fas fa-plus-circle"></i>
              </Link>
          </h6>
          <ul class="nav flex-column mb-2">
              <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/home-sliders`"
                  >
                      <i class="fas fa-sliders-h"></i>
                      Home Sliders
                  </Link>
              </li>
              <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/on-sale`"
                  >
                      <i class="fas fa-tags"></i>
                      On Sale
                  </Link>
              </li>
              <li class="nav-item">
                  <Link
                      class="nav-link"
                      :href="`${$page.props.url}admin/home-categories`"
                  >
                      <i class="fas fa-folder-open"></i>
                      Home Categories
                  </Link>
              </li>
          </ul>
      </div>
  </nav>
  <!--end sidebar-->
</template>
