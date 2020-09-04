<template>
        <div class="row justify-content-center">
            <div class="col-md-8 my-auto">
                <div class="card">
                    <div class="card-header">Home Component</div>

                    <div class="card-body">
                        <h2>{{ welcome }}</h2>
                        <a href="/test" class="float-right">Click me!</a>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        name: 'home',
        computed: {
            welcome() {
                return this.$store.getters.welcome;
            }
        }
    }
</script>