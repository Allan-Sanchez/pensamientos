<template>
    <div class="card mt-4">
        <!-- <div class="card-header">Publicado en: {{pensamiento.created_at}} {{pensamiento.updated_at}}</div> -->

        <div class="card-header">
                <p v-if="fecha_creacion != fecha_actualizacion"> <span class="float-left">Publicado en: {{fecha_creacion}}</span> <span class="float-right">Actualizado en: {{fecha_actualizacion}}</span></p>
                <p v-else> <span class="float-left">Publicado en: {{fecha_creacion}}</span> </p>
         </div>

        <div class="card-body">

            <input v-if="modoEditar" class="form-control" name="editPensamiento" type="text" v-model="pensamiento.descripcion" @keyup.enter="guardarCambios()">
            <p v-else>{{pensamiento.descripcion}}</p>
        </div>

       <div class="card-footer">
           <div class="btn-group float-right" role="group" aria-label="">
               <button v-if="modoEditar" type="button" class="btn btn-primary mr-2" @click="guardarCambios()">Guardar Cambio</button>
               <button v-else type="button" class="btn btn-success mr-2" @click="editar()">Editar</button>
               <button type="button" class="btn btn-danger ml-2" @click="eliminar()">Eliminar</button>
           </div>
       </div>
   </div>
</template>

<script>
    export default {
        props:['pensamiento'],
        data() {
            return {
                modoEditar:false,
                fecha_creacion :this.pensamiento.created_at,
                fecha_actualizacion : this.pensamiento.updated_at,
            }
        },
        mounted() {
            // console.log('Component mounted.');
        }, 
        methods: {
            eliminar(){

                axios.delete(`/pensamientos/${this.pensamiento.id}`).then(() => {
                    
                    this.$emit('eliminarlo');

                }).catch((err) => {
                    
                    console.log(err);
                    
                });


            },
            editar(){
                this.modoEditar=true;
            },
            guardarCambios(){

                let params = {
                    descripcion : this.pensamiento.descripcion
                }

                axios.put(`/pensamientos/${this.pensamiento.id}`,params).then((result) => {
                    
                    this.modoEditar = false;
                    let pensamiento = result.data;
                    this.$emit('editar',pensamiento);

                    
                }).catch((err) => {
                    console.log(err);
                    
                });

            }

        },
    }
</script>
