<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <Sidebar />
                <Content>
                    Content section
                </Content>
            </div>
        </div>
    </Layout>
</template>
<script>
import Layout from '@/Components/Admin/Shared/Layout';
import Sidebar from '@/Components/Admin/Shared/Sidebar';
import Content from '@/Components/Admin/Shared/Content';
export default  {
    components: {
       Layout,
       Sidebar,
       Content,
    }

}
</script>
