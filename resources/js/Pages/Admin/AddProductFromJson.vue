<!-- resources/js/Pages/Admin/AddProductFromJson.vue -->
<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <Sidebar />
                <Content>
                    <div class="card">
                        <div class="card-header">Add Products from JSON</div>
                        <div class="card-body">
                            <form @submit.prevent="handleFormSubmit">
                                <div class="form-group">
                                    <label for="jsonInput" class="form-label"
                                        >Products JSON:
                                    </label>
                                    <textarea
                                        class="form-control"
                                        id="jsonInput"
                                        v-model="jsonInput"
                                        placeholder="Paste your JSON object here"
                                        rows="10"
                                    ></textarea>
                                </div>
                                <button
                                    type="submit"
                                    class="mt-3 btn btn-primary"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </Content>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Components/Admin/Shared/Layout";
import Sidebar from "@/Components/Admin/Shared/Sidebar";
import Content from "@/Components/Admin/Shared/Content";

export default {
    components: {
        Layout,
        Sidebar,
        Content,
    },
    data() {
        return {
            jsonInput: null,
        };
    },
    methods: {
        handleFormSubmit() {
            try {
                const parsedJson = { products: JSON.parse(this.jsonInput) };

                // Send JSON data to the server via Inertia
                this.$inertia.post(
                    `${this.$page.props.url}admin/products/add-from-json`,
                    parsedJson
                );
            } catch (error) {
                alert("Invalid JSON format. Please check and try again.");
            }
        },
    },
};
</script>
