<template>
    <div>
        <h4>Missing</h4>
        <div v-for="mis in missing">
            <div v-if="mis.length>2">
                <div><li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;">{{ mis }}</li></div>
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