<template>
    <Head title="Register" />

    <Layout>

        
            <div class="container-fluid">

                <div class="d-flex justify-content-center">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-lg-2 bg-light">
                        <div class="">
                                <div class="register-form">

                                    <jet-authentication-card>
                                        <template #logo>
<!--                                            <jet-authentication-card-logo />-->
                                        </template>

                                        <jet-validation-errors class="mb-2" />

                                        <form @submit.prevent="submit">
                                            <div class="form-group">
                                                <jet-label class="form-label" for="name" value="Name" />
                                                <jet-input class="form-control" id="name" type="text" v-model="form.name" required autofocus autocomplete="name" />
                                            </div>

                                            <div class="form-group">
                                                <jet-label class="form-label" for="email" value="Email" />
                                                <jet-input class="form-control" id="email" type="email" v-model="form.email" required />
                                            </div>

                                            <div class="form-group">
                                                <jet-label class="form-label" for="password" value="Password" />
                                                <jet-input class="form-control" id="password" type="password" v-model="form.password" required autocomplete="new-password" />
                                            </div>

                                            <div class="form-group">
                                                <jet-label class="form-label" for="password_confirmation" value="Confirm Password" />
                                                <jet-input class="form-control" id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" />
                                            </div>

                                            <div class="form-group" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                                                <jet-label for="terms">
                                                    <div class="flex items-center">
                                                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                                                        <div class="ml-2">
                                                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                                                        </div>
                                                    </div>
                                                </jet-label>
                                            </div>

                                            <div  class="form-group">
                                                <div class="flex items-center justify-end mt-4">
                                                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                                        Already registered?
                                                    </Link>

                                                    <jet-button class="ml-2 float-end" :disabled="form.processing">
                                                        <div v-if="form.processing" class="spinner-border p-1" style="width:0;height:0;" role="status">
                                                      <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <span v-else>Register</span>
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
    import { Head, Link } from '@inertiajs/inertia-vue3';
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
            Layout,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })
</script>
