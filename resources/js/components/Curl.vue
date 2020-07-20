<template>
    <div>
        <div v-if="data.started" style="margin-bottom: 10px;"> 
            <div class="card card-default">
                <div  class="card-header"><H3>{{data.headding}}</H3></div>
                    <div  v-if="data.loaded" class="card-body">  
                            <li  v-for="(value, name) in data.data" v-bind:key="(value, name)" class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{{ value }}</pre></li>   
                    </div>
                    <div v-else  class="card-body">  
                            <li  class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;">Loading...</li>
                    </div>
            </div>
        </div>
       
    </div>
</template>
<script>
export default{
    name:"Curl",
    props: ['data']
  
}
</script>