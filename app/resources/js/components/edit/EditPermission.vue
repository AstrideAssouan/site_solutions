<script>
import { getAllPermission, getAdmin, addPermissions } from '../../services/authService';

export default {
    data() {
        return {
            permissions: [],
            adminPermissions: {},
            admin: [],
            isLoading: false
        }
    },
    mounted() {
        this.getPermisions()
        this.fetchData()
    },
    methods: {
        showAlert(message, icon) {
            this.$swal.fire({
                icon: icon,
                text: message,
            })
        },
        async getPermisions() {
            const response = await getAllPermission()
            this.permissions = Object.values(response.permissions)
        },
        async fetchData() {
            const id = this.$route.params.id
            const response = await getAdmin(id)
            this.admin = response

            if (this.admin && this.admin.permissions) {
                this.admin.permissions.forEach(permission => {
                    this.adminPermissions[permission.id] = true;
                });
            }
        },
        isPermissionChecked(permissionId) {
            if (this.admin && this.admin['permissions'] && Array.isArray(this.admin['permissions'])) {
                return this.admin['permissions'].some(permission => permission.id === permissionId);
            }
            return false; // Si les permissions ne sont pas définies ou ne sont pas un tableau
        },

        async updatePermissions() {
            this.isLoading = true
            const id = this.$route.params.id
            const permissions = this.permissions
                .filter(permission => this.adminPermissions[permission.id])
                .map(permission => permission.id);
            try {
                const response = await addPermissions(id, permissions)
                if (response.status === 200) {
                    this.showAlert(response.message, 'success');
                    this.isLoading = false;
                    this.$router.push('/back-office/user')
                } else {
                    this.showAlert(response.message, 'error');
                    this.isLoading = false;
                }
            } catch (error) {
                this.showAlert('Une erreur est survenue !', 'error')
                this.isLoading = false
                console.log(error);
            }
        },

    }
}
</script>


<template>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Permissions</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modification des permissions</h6>
            </div>
            <div class="card-body">

                <form @submit.prevent="updatePermissions">
                    <div class="form-check form-switch mb-3" v-for="(permission, index) in permissions" :key="index">
                        <input class="form-check-input" :value="permission.id" type="checkbox" :id="`flexCheck${index}`"
                            :checked="isPermissionChecked(permission.id)" v-model="adminPermissions[permission.id]">
                        <label class="form-check-label" :for="`flexCheck${index}`">
                            {{ permission.permission_name }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" :disabled="isLoading">Enregistrer</button>
                </form>
            </div>
        </div>

    </div>
</template>