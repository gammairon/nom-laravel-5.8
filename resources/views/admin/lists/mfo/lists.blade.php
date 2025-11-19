<h3 class="text-center mb-4">Группы MFO</h3>

<div id="dragDrop" class="row">
    <div class="col-xs-12 col-md-6">
        <h4 class="text-center mb-4">Все MFO</h4>

        <draggable class="admin-lists" tag="ul" :list="defaultMfos" :group="{ name: 'mfo', pull: 'clone', put: false }" @change="log" >

            <li
                class="d-flex align-items-center mb-3 justify-content-between list"
                v-for="(mfo, index) in defaultMfos"
                :key="mfo.id"
            >
                <div class="cell" data-toggle="tooltip" data-placement="top" title="Порядковый номер">{% index+1 %}</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Название МФО">{% mfo.name %}</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Максимальная сумма кредита">{% mfo.max_amount %} грн.</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Ставка для повторного кредита">{% mfo.repeat_credit_bid %}%</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Возраст мин - макс">{% mfo.min_age %}-{% mfo.max_age %} лет</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Беспроцентный кредит">{% mfo.free_credit_bid <= 0.01 ? 'да':'нет' %}</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Максимальный срок кредитования">{% mfo.max_term %} дн.</div>

                <div class="cell"><a :href="mfo.edit_link" class="btn btn-primary btn-xs" data-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
            </li>
        </draggable>

    </div>

    <div class="col-xs-12 col-md-6">
        <h4 class="text-center mb-4">Выбраные MFO</h4>
        <draggable class="admin-lists" tag="ul" :list="selectedMfos" group="mfo" @change="log" >
            <li
                class="d-flex align-items-center mb-3 justify-content-between list"
                v-for="(mfo, index) in selectedMfos"
                :key="mfo.id"
            >
                <div class="cell" data-toggle="tooltip" data-placement="top" title="Порядковый номер">{% index+1 %}</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Название МФО">{% mfo.name %}</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Максимальная сумма кредита">{% mfo.max_amount %} грн.</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Ставка для повторного кредита">{% mfo.repeat_credit_bid %}%</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Возраст мин - макс">{% mfo.min_age %}-{% mfo.max_age %} лет</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Беспроцентный кредит">{% mfo.free_credit_bid <= 0.01 ? 'да':'нет' %}</div>

                <div class="cell" data-toggle="tooltip" data-placement="top" title="Максимальный срок кредитования">{% mfo.max_term %} дн.</div>

                <div class="cell"><a :href="mfo.edit_link" class="btn btn-primary btn-xs" data-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>

                <div class="cell"><a href="#" @click.prevent="removeMfo(index)" class="btn btn-danger btn-xs" data-title="Remove"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
            </li>
        </draggable>

    </div>

    <rawDisplayer class="col-xs-12 col-md-6" :value="defaultMfos" title="Все MFO" />

    <rawDisplayer class="col-xs-12 col-md-6" :value="selectedMfos" title="Выбраные MFO" />

    <input type="hidden" name="mfo_ids" :value="mfo_ids">
</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js"></script>
<!-- CDNJS :: Sortable (https://cdnjs.com/) -->
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
<!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js" type="module"></script>

<script type="module">

    var vm = new Vue({
        el: '#dragDrop',
        delimiters: ['{%', '%}'],


        data: function () {
            return {
                defaultMfos: [],
                selectedMfos: [],
            };
        },
        created(){
            this.defaultMfos = {!! json_encode($defaultMfos) !!};
            this.selectedMfos = {!! json_encode($selectedMfos) !!};
        },
        computed: {
            mfo_ids: function () {
                var ids = [];

                for (var key in this.selectedMfos) {
                    ids.push(this.selectedMfos[key].id);
                }

                return ids;
            }
        },
        watch: {

        },
        methods: {
            removeMfo: function (index) {
                this.selectedMfos.splice(index, 1);
            },

            log: function(evt) {
                //window.console.log(evt);
            }

        },
    });
</script>
