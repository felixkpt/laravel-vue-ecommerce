<template>
    <Head title="Log in" />

    <Layout>
            <div class="container-fluid">

                <div class="d-flex justify-content-center">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-lg-2 bg-light">
                        <div class="">
                                <div class="login-form">

                                    <jet-authentication-card>
                                        <template #logo>
                                            <!--            <jet-authentication-card-logo />-->
                                        </template>

                                        <jet-validation-errors class="mb-2" />

                                        <div v-if="status" class="mb-2 text-success">
                                            {{ status }}
                                        </div>

                                        <form @submit.prevent="submit">
                                            <div class="form-group">
                                                <jet-label class="form-label" for="email" value="Email" />
                                                <jet-input class="form-control" id="email" type="email" v-model="form.email" required autofocus />
                                            </div>

                                            <div class="form-group">
                                                <jet-label class="form-label" for="password" value="Password" />
                                                <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">
                                                    <jet-checkbox name="remember" v-model:checked="form.remember" />
                                                    Remember me
                                                    </label>
                                            </div>

                                            <div class="form-group">
                                                <div class="flex items-center justify-end mt-4">
                                                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                                    Forgot your password?
                                                </Link>

                                                <jet-button class="ms-2 float-end" :disabled="form.processing">
                                                   <div v-if="form.processing" class="spinner-border p-1" style="width:0;height:0;" role="status">
                                                      <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <span v-else>Log in</span>
                                                </jet-button>
                                            </div>
                                            </div>
                                        </form>
                                    </jet-authentication-card>

                                </div>
                        </div><!--end main products area-->
                    </div>
                </div><!--end row-->

            </div><!--end container-->

            <!-- end .container-fluid -->
    </Layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head } from '@inertiajs/inertia-vue3';
    import Layout from '@/Components/Shared/Layout';
    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Layout
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },
        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },
        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
