<script setup>
import SideBar from '../components/SideBar.vue';
import Topnav from '../components/Topnav.vue';
</script>

<template>
    <div id="wrapper">
        <SideBar />

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Topnav />

                <router-view></router-view>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</template>