<script>
import { getRole, addAdmin } from '../../services/authService';

export default {
    data() {
        return {
            data: {
                nom: '',
                prenom: '',
                email: '',
                password: '',
                role: null,
            },
            role: [],
            isLoading: false
        }
    },
    mounted() {
        this.fetchRole()
    },
    methods: {
        sweetAlert(icon, message) {
            this.$swal.fire({
                icon: icon,
                text: message,
            })
        },
        async fetchRole() {
            const response = await getRole()
            this.role = response
        },
        async addData() {
            this.isLoading = true
            try {
                const response = await addAdmin(this.data)
                if (response.status === 200) {
                    this.isLoading = false
                    this.sweetAlert('success', response.message)
                    this.$emit('nouvelleEntreeAjoutee');
                    this.closeModal()
                    this.resetForm()
                } else {
                    this.isLoading = false
                    this.sweetAlert('error', response.message)
                }
            } catch (error) {
                this.isLoading = false
                this.sweetAlert('error', error.message)
            }
        },
        closeModal() {
            const modal = document.getElementById('publicModal');
            modal.classList.remove('show');
            modal.style.display = 'none';
            const backdrop = document.getElementsByClassName('modal-backdrop')[0];
            backdrop.remove();
        },
        resetForm() {
            var self = this; 
            Object.keys(this.data).forEach(function (key, index) {
                self.data[key] = '';
            });
        }
    }
}
</script>

<template>
    <form @submit.prevent="addData">
        <div class="modal fade" id="publicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel utilisateur</h5>
                        <button type="button" class="text-primary" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bx bx-x"></i></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" v-model="data.nom" id="nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prenom</label>
                                    <input type="text" class="form-control" v-model="data.prenom" id="prenom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" class="form-control" v-model="data.email"
                                        id="exampleFormControlInput1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" required id="role" v-model="data.role">
                                        <option v-for="(row, index) in role" :key="index" :value="row.nom_role">{{
                                            row.nom_role }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" v-model="data.password" id="password" required>
                                </div>
                            </div>

                            <div class="col-md-4"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</template>