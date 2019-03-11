<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
             <!-- componente para el formulario de nuevos pensamientos  -->
            <form-component @nuevo="agregarPensamiento"></form-component>

            <!-- componente para los pensamiento  -->
            <pensamientos-component 
             v-for="(pensamiento,index) in pensamientos" :key="pensamiento.id" :pensamiento="pensamiento" @eliminarlo="eliminarPensaminto(index)" @editar="editarPensamiento(index,...arguments)"></pensamientos-component>
            

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pensamientos:[]
            }
        },
        mounted() {
            axios.get('/pensamientos').then((result) => {
                this.pensamientos = result.data;
            }).catch((err) => {
                console.log(err);
                
            });;
        },
        methods: {
            agregarPensamiento(pensamiento){

                pensamiento.descripcion.trim();
                if (pensamiento.descripcion) {
                    
                    this.pensamientos.push(pensamiento);
                }
                



            },
            eliminarPensaminto(index){
                this.pensamientos.splice(index,1);
            },
            editarPensamiento(index,pensamiento){
                this.pensamientos[index]= pensamiento;
                
                
            }
        },
    }
</script>
