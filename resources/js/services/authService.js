import {api} from '../api'

export function getStore() {
    const admin = localStorage.getItem('admin')
    const data = JSON.parse(admin)
    return data
}

export async function addAdmin(formdata) {
    try {
        const response = await api.post('/add-admin', formdata)
        return response.data
    } catch (error) {
        throw Error("Une erreur est survenue !")
    }
}

export async function editAdmin(formdata, id) {
    try {
        const response = await api.post(`/edit-admin?id=${id}`, formdata)
        return response.data
    } catch (error) {
        throw Error("Une erreur est survenue !")
    }
}

export async function getAllService(search='', currentPage){
    try {
        const response = await api.get(`/get-admin?page=${currentPage}&search=${search}`)
        return response.data
    } catch (error) {
        throw Error("Une erreur est survenue !")
    }
}

export async function getRole(){
    try {
        const response = await api.get(`/get-role`)
        return response.data
    } catch (error) {
        throw Error("Une erreur est survenue !")
    }
}

export async function addPermissions(userId, permissions){
    try {
        const response = await api.post(`/add-permissions/${userId}/add`, {permission_id:permissions})
        return response.data
    } catch (error) {
        console.log(error);
        throw Error('Une erreur s\'est produite')
    }
}

export async function getAllPermission(){
    try {
        const response = await api.get('/get-permissions')
        return response.data
    } catch (error) {
        throw Error('Une erreur s\'est produite')
    }
}

export async function getAdmin(id){
    try {
        const response = await api.get(`/get-one-admin?id=${id}`)
        return response.data
    } catch (error) {
        throw Error("Une erreur est survenue !")
    }
}

export async function login(formdata){
    try {
        const response = await api.post(`/login`, formdata)
        return response.data
    } catch (error) {
        throw Error ("Une erreur est survenue")
    }
}

export async function logout(){
    try {
        const response = await api.post(`/logout`)
        return response.data
    } catch (error) {
        throw Error ("Une erreur est survenue")
    }
}

export async function deleteAdmin(id){
    try {
        const response = await api.delete(`/delete-admin?id=${id}`)
        return response.data
    } catch (error) {
        throw Error("Une erreur est survenue !")
    }
}