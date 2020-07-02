<template>
    <div>
        <h4>Missing</h4>
        <div v-for="mis in missing" v-bind:key="mis">
            <div v-if="mis.length>2">
                <div><li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><span style="color:#cd8000;">{{ mis }}</span></li></div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:"missingSH",
    props: ['missing']
  
}
</script>