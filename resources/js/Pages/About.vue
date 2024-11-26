<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class=" main-content-area">
                        <h1>About Us | Quick shoppers a Powerful e-commerce website</h1>
                        <p>
                            We are a rapidly growing online commerce website with good customer relationship and trust.
                        </p>
                        <p>
                            Our Products are of good quality and delivery is guaranteed with return policy upto 1 one after purchase.
                        </p>
                        <h2>Features</h2>
                        <h3>User Experience</h3>
                        <p>
                            Utilizing Vue 3 smooth transitions, with Bootstrap stylings, the application was carefully designed for ensuring good user experience. Our clients need to be able to find their way around our website so as the will likely make purchases effortlessly.

                        The homepage is high-quality, simple, straightforward that is bundled with a search bar. The side navigation aids users easily navigate to different categories. Responsiveness of the website has been verified accross many platforms and devices.

                        </p>
                        <h3>Multiple payments</h3>
                        <p>
                            Implementation of multi-vendor payments methods is underway and the customers abandoning their carts will drop after the completion of this feature as is often a big issue for online retailers when there's a limited option for the client to use in the checkout. We will also incoporate credit and debit cards options inline with top payment providers like PayPal or Stripe.
                        </p>
                        <h3>24/7 Customer Service</h3>
                        <p>
                            We providing helpful, accessible customer service as it is an important aspect of a good client experience. Clients regard customer service to be a critical factor in determining whether or not to buy from a business. Chat with us at any time and we will respond as soon as possible.
                        </p>
                        <h3>Extensive product information</h3>
                        <p>
                            Although shopping online has become increasingly popular, many customers remain wary of making purchases online, particularly from smaller firms with whom they are unfamiliar.

                        Consumers who buy online face the drawback of not being able to view or sample the goods before making a purchase.

                        We have made sure that we include as much product information as possible for our buyers to know that our products is of good quality and worth their money.

                        All products have descriptions that include information about size, material, color, ingredients, and origin. We also have provided high-resolution product photos that show the product from all sides. Photographs of a model wearing the item if it's apparel can also be found.

                        Similar items sections to product pages have been categorized so that customers may find additional products that are tailored to their preferences and needs.
                        </p>
                        <h3>Reliable internet security program.</h3>
                        <p>
                            Our shop is operated on HTTPS protocal which is secure, We use an efficient internet security program as this is the best way to be secured online. Shopping is no different. Instead, as the number of products and data traded online grows, security measures such as real-time anti-phishing and identity theft protection are deployed, for instance we filter any.exe files, and also discard any malicious emails, while also filtering unwanted spam email into a separate folder.
                        </p>
                        <p>
                            Let the buying spree begin...
                        </p>
                     </div><!--end main content area-->
                </div><!--end main products area-->
                <Sidebar />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
export default  {
    components: {
       Layout,
       Sidebar,
    },
    data() {
        return {
        }
    }

}
</script>
