<template>
    <div>
        <div v-if="handshakes.started" style="margin-bottom: 10px;"> 
            <div class="card card-default">
            <div class="card-header"><H3>{{handshakes.headding}}</H3></div>
                <div v-if="handshakes.loaded"> 
                    <div v-for="(value, name) in handshakes.data">
                        <div v-if="value.length>2"> <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{{ value }}</pre></li></div>
                    </div>
                </div>
                <div v-else><li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;">Loading...</li></div>
                </div>
            </div>
        <div v-else></div>
    </div>
</template>

<script>
export default{
    name:"Handshakes",
    props: ['handshakes']
  
}
</script>