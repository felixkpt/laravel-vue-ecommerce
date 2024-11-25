<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <Sidebar />
                <Content>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4>All Users</h4>
                                </div>
                                <div class="col-6 text-end">
                                    <Link
                                        :href="`${$page.props.url}admin/users/export`"
                                        class="btn btn-success btn-sm me-2"
                                        >Export</Link
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Img</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(user, index) in $page.props
                                            .users.data"
                                        :key="user.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <div class="avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.created_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button
                                                    id="btnGroupDropActions"
                                                    type="button"
                                                    class="btn btn-light dropdown-toggle"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                >
                                                    Actions
                                                </button>
                                                <ul
                                                    class="dropdown-menu"
                                                    aria-labelledby="btnGroupDropActions"
                                                >
                                                    <li>
                                                        <a
                                                            target="_blank"
                                                            class="dropdown-item"
                                                            :href="`${$page.props.url}user/${user.slug}`"
                                                        >
                                                            <span
                                                                class="fa fa-eye text-dark"
                                                            ></span>
                                                            View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <Link
                                                            class="dropdown-item"
                                                            :href="`${$page.props.url}admin/users/edit/${user.slug}`"
                                                        >
                                                            <span
                                                                class="fa fa-edit text-info"
                                                            ></span>
                                                            Edit
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link
                                                            class="dropdown-item"
                                                            @click.prevent="
                                                                deleteItem(
                                                                    user.id
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                class="fa fa-trash text-danger"
                                                            ></span>
                                                            Delete
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <PaginationLinks :links="links" />
                        </div>
                    </div>
                </Content>
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <!-- end .container-fluid -->
    </Layout>
</template>

<script>
import Layout from "@/Components/Admin/Shared/Layout";
import Sidebar from "@/Components/Admin/Shared/Sidebar";
import Content from "@/Components/Admin/Shared/Content";
import PaginationLinks from "@/Components/Shared/PaginationLinks";
export default {
    components: {
        Layout,
        Sidebar,
        Content,
        PaginationLinks,
    },
    data() {
        return {
            links: this.$page.props.users,
        };
    },
    methods: {
        deleteItem(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                this.$inertia.delete(`/admin/users/delete/${id}`);
            }
        },
    },
    mounted() {
        // console.log(this.$page.props.users)
    },
};
</script>

<style scoped>
.avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0; /* Light gray background */
    border-radius: 50%; /* Makes it circular */
    font-size: 24px; /* Size of the Font Awesome icon */
    color: #555; /* Icon color */
}
</style>
