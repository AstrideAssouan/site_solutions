<script>
import {getAdmin, getStore} from '../services/authService';
import {useRoute} from 'vue-router';

export default {
    data() {
        return {
            isCollapsed: true, // Initialisez la collapsible comme rétractée (collapsed)
            admin:{},
            data: getStore()
        };
    },
    setup() {
        const route = useRoute();

        const isActive = (name) => {
            return route.name === name;
        };

        return {
            isActive
        };
    },
    computed: {
        collapseId() {
            return this.isCollapsed ? "" : "collapseTwo"; // Ajustez l'ID en fonction de l'état collapsible
        },
    },
    mounted(){
        this.fetchadmin()
    },
    methods: {
        toggleCollapse() {
            this.isCollapsed = !this.isCollapsed; // Inversez l'état collapsible au clic
        },
        async fetchadmin() {
            const response = await getAdmin(this.data.id)
            this.admin = response
        },
        hasPermissions(permission) {
            if (this.admin && this.admin.permissions && this.admin.permissions.length > 0) {
                const permissionNames = this.admin.permissions.map(p => p.permission_name);
                return permissionNames.includes(permission);
            }
            return false;
        },
    },
};
</script>

<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #00c9a7!important;">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/back-office/dashboard">
            <div class="sidebar-brand-icon">
                <img src="../../img/logo_akpany.png" alt="Akpany logo">
            </div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item" :class="{ 'nav-item active': isActive('dashboard') }">
            <router-link class="nav-link" to="/back-office/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tableau de bord</span></router-link>
        </li>

        <li class="nav-item" v-if="hasPermissions('accès utilisateurs')" :class="{ 'nav-item active': isActive('user') }">
            <router-link class="nav-link" to="/back-office/user">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Utilisateurs</span></router-link>
        </li>

        <li class="nav-item" v-if="hasPermissions('accès projets')" :class="{ 'nav-item active': isActive('projets') }">
            <router-link class="nav-link" to="/back-office/projets">
                <i class="fa fa-fw fa-file"></i>
                <span>Projets</span>
            </router-link>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Sevices
        </div>

        <li class="nav-item" v-if="hasPermissions('accès type service')" :class="{ 'nav-item active': isActive('type-service')}">
            <router-link class="nav-link" to="/back-office/type-service">
                <i class="fas fa-fw fa-tasks"></i>
                <span>Type de services</span></router-link>
        </li>

        <li class="nav-item" v-if="hasPermissions('accès liste services')" :class="{ 'nav-item active': isActive('services') }">
            <router-link class="nav-link" to="/back-office/services" >
                <i class="fas fa-fw fa-cog"></i>
                <span>Listes des services</span>
            </router-link>
        </li>

        <li class="nav-item" v-if="hasPermissions('accès demandes de services')" :class="{ 'nav-item active': isActive('demande-service') }">
            <router-link class="nav-link" to="/back-office/demande-service">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Demandes de services</span></router-link>
        </li>

        <hr class="sidebar-divider">


        <div class="sidebar-heading">
            Offres d'emploi
        </div>
        <li class="nav-item" v-if="hasPermissions('accès categories')" :class="{ 'nav-item active': isActive('categorie') }">
            <router-link class="nav-link" to="/back-office/categorie">
                <i class="fas fa-fw fa-tasks"></i>
                <span>Catégories</span></router-link>
        </li>

        <li class="nav-item" v-if="hasPermissions('accès listes des offres')" :class="{ 'nav-item active': isActive('emploi') }">
            <router-link class="nav-link" to="/back-office/emploi">
                <i class="fas fa-fw fa-tasks"></i>
                <span>Listes des offres d'emploi</span></router-link>
        </li>


        <li class="nav-item" v-if="hasPermissions('accès candidatures')" :class="{ 'nav-item active': isActive('candidats') }">
            <router-link class="nav-link" to="/back-office/candidats">
                <i class="fas fa-fw fa-admins"></i>
                <span>Candidatures</span></router-link>
        </li>

    </ul>
</template>