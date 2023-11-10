<script>
import { getCategories, getEmploi, editEmploi } from '../../services/gestionServices';


export default {
    data() {
        return {
            data: {
                intitule_poste: '',
                date_publication: '',
                date_limite: '',
                niveau_etude: '',
                localisation: '',
                secteur_activite: '',
                description_poste: '',
                missions: '',
                remuneration: '',
                categorie_id: null,
            },
            isLoading: false,
            category: [],
        }
    },
    mounted() {
        this.fetchData()
        this.fetchCategory()
    },
    methods: {
        sweetAlert(icon, message) {
            this.$swal.fire({
                icon: icon,
                text: message,
            })
        },
        async fetchData() {
            const id = this.$route.params.id
            const response = await getEmploi(id)
            this.data = {
                intitule_poste: response.intitule_poste,
                date_publication: response.date_publication,
                date_limite: response.date_limite,
                niveau_etude: response.niveau_etude,
                localisation: response.localisation,
                secteur_activite: response.secteur_activite,
                description_poste: response.description_poste,
                missions: response.missions,
                remuneration: response.remuneration,
                categorie_id: response.categorie_id,
            }
        },
        async fetchCategory() {
            const response = await getCategories()
            this.category = response
        },
        async editData(){
            this.isLoading = true
            try {
                const id = this.$route.params.id
                const response = await editEmploi(this.data, id)
                if (response.status === 200) {
                    this.isLoading = false
                    this.sweetAlert('success', response.message)
                    this.$router.push('/back-office/emploi')
                } else {
                    this.isLoading = false
                    this.sweetAlert('error', response.message)
                }
            } catch (error) {
                this.isLoading = false
                this.sweetAlert('error', error.message)
            }
        },
    }
}
</script>

<template>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Emploi</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informations détaillées sur l'emploi</h6>
            </div>
            <div class="card-body">

                <form @submit.prevent="editData">

                    <div class="mb-3">
                        <label for="intitule_poste" class="form-label">Intitulé du poste</label>
                        <input type="text" v-model="data.intitule_poste" class="form-control" id="intitule_poste" required>
                    </div>
                    <div class="mb-3">
                        <label for="description_poste" class="form-label">Description du poste</label>
                        <textarea class="form-control" v-model="data.description_poste" id="description_poste" required
                            cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="niveau_etude" class="form-label">Niveau d'étude</label>
                        <input type="text" v-model="data.niveau_etude" class="form-control" id="niveau_etude" required>
                    </div>
                    <div class="mb-3">
                        <label for="secteur_activite" class="form-label">Secteur d'activité</label>
                        <input type="text" v-model="data.secteur_activite" class="form-control" id="secteur_activite">
                    </div>
                    <div class="mb-3">
                        <label for="missions" class="form-label">Missions</label>
                        <textarea class="form-control" v-model="data.missions" id="missions" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="localisation" class="form-label">Localisation</label>
                        <input type="text" class="form-control" v-model="data.localisation" id="localisation" required>
                    </div>
                    <div class="mb-3">
                        <label for="remunération" class="form-label">Remunération</label>
                        <input type="text" v-model="data.remuneration" class="form-control" id="remunération" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_publication" class="form-label">Date de publication</label>
                        <input type="date" v-model="data.date_publication" class="form-control" id="date_publication"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="date_limite" class="form-label">Date limite</label>
                        <input type="date" v-model="data.date_limite" class="form-control" id="date_limite" required>
                    </div>
                    <div class="mb-3">
                        <label for="type_ser" class="form-label">Categorie</label>
                        <select class="form-select" v-model="data.categorie_id" required id="typer_ser">
                            <option v-for="(row, index) in category" :key="index" :value="row.id">{{
                                row.libelle_cat }}
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" :disabled="isLoading">Enregistrer</button>

                </form>
            </div>
        </div>

    </div>
</template>