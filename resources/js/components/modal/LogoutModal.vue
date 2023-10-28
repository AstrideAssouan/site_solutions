<script>
import {logout} from '../../services/authService';

export default {
    data(){
        return{
            isLoading:false,
        }
    },
    methods:{
        sweetAlert(icon, message) {
            this.$swal.fire({
                icon: icon,
                text: message,
            })
        },
        async deconnexion(){
            this.isLoading = true
            try {
                const response = await logout()
                if(response.status === 200){
                    localStorage.removeItem('auth_token')
                    localStorage.removeItem('admin')
                    this.sweetAlert('success', response.message)
                    this.$router.push('/back-office/login')
                    this.isLoading = false
                }else{
                    this.sweetAlert('error', "Une erreur est survenue")
                    this.isLoading = false
                }
            } catch (error) {
                this.sweetAlert('error', error.message)
            }
        }
    }
}
</script>

<template>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à le faire ?</h5>
                    <button type="button" class="text-primary" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bx bx-x"></i></button>
                </div>
                <div class="modal-body">Selectionnez "Déconnexion" si vous êtes prêt à le faire.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" @click="deconnexion()" :disabled="isLoading">Deconnexion</button>
                </div>
            </div>
        </div>
    </div>
</template>