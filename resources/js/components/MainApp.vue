<template>
    <div id="main">
        <Header />
        <div class="container content py-5">
            <transition name="slide">
                <router-view></router-view>
            </transition>
        </div>
    </div> 
</template>

<script>
    import Header from './Header.vue';

    export default {
        name: 'main-app',
        components: {Header}
    }
</script>