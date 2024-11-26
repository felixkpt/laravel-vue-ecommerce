<template>
    <Layout>
        <div class="container-fluid dashboard">
            <div class="row">
                <Sidebar />
                <Content>
                    <div class="row mb-4" style="margin-top: 2rem">
                        <!-- Cards -->
                        <div
                            class="col-md-3"
                            v-for="(card, index) in cards"
                            :key="index"
                        >
                            <Link
                                :href="card.link"
                                class="text-decoration-none"
                            >
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-dark">
                                            {{ card.label }}
                                        </h5>
                                        <h3 class="text-primary">
                                            {{ card.value }}
                                        </h3>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!-- Graphs -->
                    <div class="row" style="margin-top: 3rem">
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Orders Overview</h5>
                                    <canvas id="ordersGraph"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Revenue Overview</h5>
                                    <canvas id="revenueGraph"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </Content>
            </div>
        </div>
    </Layout>
</template>

<script>
import axios from "axios";
import Layout from "@/Components/Admin/Shared/Layout";
import Sidebar from "@/Components/Admin/Shared/Sidebar";
import Content from "@/Components/Admin/Shared/Content";
import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

export default {
    components: {
        Layout,
        Sidebar,
        Content,
    },
    data() {
        return {
            cards: [],
            stats: null,
        };
    },
    async mounted() {
        await this.fetchStats();
        this.initializeGraphs();
    },
    methods: {
        async fetchStats() {
            try {
                const { data } = await axios.get("/admin/stats");
                this.cards = [
                    {
                        label: "Total Users",
                        value: data.total_users,
                        link: "/admin/users",
                    },
                    {
                        label: "Total Products",
                        value: data.total_products,
                        link: "/admin/products",
                    },
                    {
                        label: "Total Categories",
                        value: data.total_categories,
                        link: "/admin/categories",
                    },
                    {
                        label: "Total Orders",
                        value: data.total_orders,
                        link: "/admin/orders",
                    },
                ];
                this.stats = data;
            } catch (error) {
                console.error("Error fetching stats:", error);
            }
        },
        initializeGraphs() {
            if (this.stats) {
                // Orders Graph
                const ctx1 = document
                    .getElementById("ordersGraph")
                    .getContext("2d");
                new Chart(ctx1, {
                    type: "bar",
                    data: {
                        labels: ["Orders"],
                        datasets: [
                            {
                                label: "Orders",
                                data: [this.stats.total_orders],
                                backgroundColor: "#007bff",
                            },
                        ],
                    },
                });

                // Revenue Graph
                const ctx2 = document
                    .getElementById("revenueGraph")
                    .getContext("2d");
                new Chart(ctx2, {
                    type: "line",
                    data: {
                        labels: ["Revenue"],
                        datasets: [
                            {
                                label: "Total Revenue",
                                data: [this.stats.total_revenue],
                                borderColor: "#28a745",
                                fill: false,
                            },
                        ],
                    },
                });
            }
        },
    },
};
</script>
<style>
.dashboard .card {
    border-radius: 0.5rem;
    transition: transform 0.2s ease-in-out;
}
.dashboard .card:hover {
    transform: translateY(-5px);
}
</style>
