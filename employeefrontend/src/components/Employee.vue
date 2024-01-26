<template>
    <div>
      <h2>Employee Registation</h2>
                    <form @submit.prevent="save">
                    
                    <div class="form-group">
                        <label>Employee name</label>
                        <input type="text" v-model="employee.name" class="form-control"  placeholder="Employee name">
                    
                    </div>

                    <div class="form-group">
                        <label>Employee Address</label>
                        <input type="text" v-model="employee.adress" class="form-control"  placeholder="Employee Address">
                    
                    </div>

                    
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" v-model="employee.mobile" class="form-control"  placeholder="Mobile">
                    
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
 
 
<h2>Employee View</h2>
      <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Employee Name</th>
      <th scope="col">Address</th>
      <th scope="col">Mobile</th>
      <th scope="col">Option</th>
    </tr>
  </thead>

  <tbody>
    <tr v-for="employee in result" v-bind:key="employee.id">
          
          <td>{{ employee.id }}</td>
          <td>{{ employee.name }}</td>
          <td>{{ employee.adress }}</td>
          <td>{{ employee.mobile }}</td>
          <td>
            <button type="button" class="btn btn-warning" @click="edit(employee)">Edit</button>
            <button type="button" class="btn btn-danger"  @click="remove(employee)">Delete</button>
          </td>
        </tr>
    
  </tbody>

  
</table>
     
    </div>

  </template>

  <script>
    import Vue from 'vue';
    import axios from 'axios';
 
     Vue.use(axios)
 
 
  export default {
    name: 'Employee',
    data () {
      return {
        result: {},
        employee:{
                   id: '',
                   name: '',
                   adress: '',
                   mobile: ''
                   
 
 
        }
      }
    },
    created() { 
        this.EmployeeLoad();
    },
    mounted() {
          console.log("mounted() called.......");
         
      },
 
    methods: {
           EmployeeLoad()
           {
                 var page = "http://127.0.0.1:8000/api/employees";
                 axios.get(page)
                  .then(
                      ({data})=>{
                        console.log(data);
                        this.result = data;
                      }
                  );
           },
           
          
           save()
           {
            if(this.employee.id == '')
              {
                this.saveData();
              }
              else
              {
                this.updateData();
              }       
 
           },
           saveData()
           {
            axios.post("http://127.0.0.1:8000/api/save", this.employee)
            .then(
              ({data})=>{
                alert("saveddddd");
                this.EmployeeLoad();
                 this.employee.name = '';
                  this.employee.adress = '',
                  this.employee.mobile = ''
                   this.id = ''
              }
            )
 
           },
           edit(employee)
           {
            this.employee = employee;
           
           },
           updateData()
           {
              var editrecords = 'http://127.0.0.1:8000/api/update/'+ this.employee.id;
              axios.put(editrecords, this.employee)
              .then(
                ({data})=>{
                  this.employee.name = '';
                  this.employee.adress = '',
                  this.employee.mobile = ''
                  this.id = ''
                  alert("Updated!!!");
                  this.EmployeeLoad();
                }
              );
 
           },
 
           remove(employee){
 
             var url = `http://127.0.0.1:8000/api/delete/${employee.id}`;
 
 
 
             // var url = 'http://127.0.0.1:8000/api/delete/'+ employee.id;
              axios.delete(url);
              alert("Deleteddd");
              this.EmployeeLoad();
            }
      }
  }
  </script>