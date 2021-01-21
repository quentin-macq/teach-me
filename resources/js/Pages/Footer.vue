<template>
    <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <footer class="py-2">
            <div class="container">
                <div
                    class="d-flex justify-content-between align-items-center flex-column flex-md-row border-bottom pb-2">
                    <h5 class="mr-0 mr-md-5 mb-0 order-1 order-md-2"><a class="text-decoration-none text-center"
                                                                        href="/">TeachMe</a>
                    </h5>

                    <ul class="nav order-3 order-md-3">
                        <li class="nav-item"><a class="nav-link" href="/credits">Informations</a></li>
                        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    </ul>

                </div>

                <div class="d-flex justify-content-center">
                    <p class="mb-0 small text-muted">© TeachMe | Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>

footer {
    z-index: 99;
    bottom: 0;
    width: 100%;
    background-color: #D4EDDA;
    position: fixed;
}

</style>
