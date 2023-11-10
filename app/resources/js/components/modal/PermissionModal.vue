<script>
import { getAllPermission, getAdmin } from '../../services/authService';

export default {
    props: [
        'userId'
    ],
    data() {
        return {
            permissions: [],
            adminPermissions: {},
            admin: []
        }
    },
    mounted() {
        this.getPermisions()
        this.fetchData()
    },
    methods: {
        async getPermisions() {
            const response = await getAllPermission()
            this.permissions = Object.values(response.permissions)
        },
        async fetchData() {
            const id = this.userId
            const response = await getAdmin(id)
            this.data = response

            if (this.admin[0] && this.admin[0].permissions) {
                this.admin[0].permissions.forEach(permission => {
                    this.adminPermissions[permission.id] = true;
                });
            }
        },
        isPermissionChecked(permissionId) {
            return this.admin[0]['permissions'].some(permission => permission.id === permissionId);
        },
    }
}
</script>

<template>
    <form action="">
        <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Permissions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check form-switch" v-for="(permission, index) in permissions" :key="index">
                            <input class="form-check-input" :value="permission.id" type="checkbox" :id="`flexCheck${index}`"
                                :checked="isPermissionChecked(permission.id)" v-model="adminPermissions[permission.id]">
                            <label class="form-check-label" :for="`flexCheck${index}`">
                                {{ permission.permission_name }}
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>