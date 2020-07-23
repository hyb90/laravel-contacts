import axios, { Button } from '../../../public/js/app';
<template>
    <div class="container">
        <h1>Contacts</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div v-show="!edit" class="card-header">ADD Contacts</div>
                    <div v-show="edit" class="card-header">Edit Contacts<button v-show="edit" class="btn btn-primary float-right" @click="cancelEdit()">Cancel</button></div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
                            <div class="form-group">
                            <lable for="title">Name</lable>
                            <input v-model="contact.name" type="text" name="name" class="form-control" required>

                            </div>
                            <div class="form-group">
                            <lable for="title">Email</lable>
                            <input v-model="contact.email"  type="email" name="email" class="form-control" required>

                            </div>
                            <div class="form-group">
                            <lable for="title">Phone Number</lable>
                            <input v-model="contact.phone"  type="tel" name="phone" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{6}" required>
                            <small>Format: 123-456-789000</small>
                            </div>

                            <div class="form-group">
                            <div class="text-center">
                            <button v-show="!edit" class="btn btn-success" type="submit">Add Contact</button>
                            <button v-show="edit" class="btn btn-success" type="submit">Update Contact</button>
                            </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h2>Contacts list</h2>
        <ul class='list-group'>
            <li class='list-group-item' v-for="contact in list" v-bind:key="contact.id">
                Name: {{contact.name}} || phone Number: +{{contact.phone}}
                <button @click="showContact(contact.id)" class="btn btn-primary btn-xs">Edit</button>
                <button @click="deleteContact(contact.id)" class="btn btn-danger btn-xs">delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                edit:false,
                list:[],
                contact:{
                    id:'',
                    name:'',
                    email:'',
                    phone:''
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.fetchContact();
        },
        methods:{
            fetchContact(){
                axios.get('api/contacts').then((r)=>{
                this.list=r.data;
            }).catch((e)=>console.log(e.response));
            },
            createContact(){
                let para=Object.assign({},this.contact);
                axios.post('api/contact/store', this.contact).then((r)=>{
                this.contact.name='';
                this.contact.email='';
                this.contact.phone='';
                this.edit=false;
                this.fetchContact();
            }).catch((e)=>console.log(e.response));
            },
            showContact(id){
                axios.get('api/contact/'+id).then((r)=>{
                this.contact.id=r.data.id;
                this.contact.name=r.data.name;
                this.contact.email=r.data.email;
                this.contact.phone=r.data.phone;
                this.edit=true;
            }).catch((e)=>console.log(e.response));
            },
            updateContact(id){
                axios.patch('api/contact/update/'+id, this.contact).then((r)=>{
                this.contact.name='';
                this.contact.email='';
                this.contact.phone='';
                this.edit=false;
                this.fetchContact();
            }).catch((e)=>console.log(e.response));
            },
            deleteContact(id){
                axios.delete('api/contact/delete/'+id).then((r)=>{
                this.fetchContact();
            }).catch((e)=>console.log(e.response));
            },
            cancelEdit(){
                this.contact.name='';
                this.contact.email='';
                this.contact.phone='';
                this.edit=false;
            },

        }
    }
</script>
