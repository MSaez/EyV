<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ot".
 *
 * @property int $OT_ID
 * @property int $OD_ID
 * @property int $CBR_ID
 * @property int $VEH_ID
 * @property int $CLI_ID
 * @property string $OT_INICIO
 * @property string $OT_ENTREGA
 * @property string $OT_OBSERVACIONES
 * @property string $OT_ESTADO
 * @property int $OT_TDESABOLLADURA
 * @property int $OT_TPINTURA
 * @property int $OT_TINSUMO
 * @property int $OT_TEXTERNO
 * @property int $OT_TREUTILIZADO 
 * @property int $OT_SUBTOTAL
 * @property int $OT_IVA
 * @property int $OT_TOTAL
 * @property int $OT_TOTAL_HORAS
 * @property string $OT_EDES
 * @property string $OT_EPIN
 *
 * @property ActividadDesabolladura[] $actividadDesabolladuras
 * @property ActividadPintura[] $actividadPinturas
 * @property Cobros[] $cobros
 * @property Despacho[] $despachos
 * @property Insumo[] $insumos
 * @property Inventario[] $inventarios
 * @property Despacho $oD
 * @property Cobros $cBR
 * @property Cliente $cLI
 * @property Vehiculo $vEH
 * @property OtrosServicios[] $otrosServicios
 */
class Ot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OD_ID', 'CBR_ID', 'VEH_ID', 'CLI_ID', 'OT_TDESABOLLADURA', 'OT_TPINTURA', 'OT_TINSUMO', 'OT_TEXTERNO', 'OT_TREUTILIZADO', 'OT_SUBTOTAL', 'OT_IVA', 'OT_TOTAL', 'OT_TOTAL_HORAS'], 'integer'],
            [['VEH_ID', 'CLI_ID', 'OT_INICIO', 'OT_ENTREGA', 'OT_OBSERVACIONES', 'OT_TDESABOLLADURA', 'OT_TPINTURA', 'OT_TINSUMO', 'OT_TEXTERNO', 'OT_TREUTILIZADO', 'OT_SUBTOTAL', 'OT_IVA', 'OT_TOTAL', 'OT_TOTAL_HORAS'], 'required'],
            [['OT_INICIO', 'OT_ENTREGA'], 'safe'],
            [['OT_OBSERVACIONES'], 'string'],
            [['OT_ESTADO'], 'string', 'max' => 12],
            [['OT_EDES', 'OT_EPIN'], 'string', 'max' => 10],
            [['OT_ENTREGA'], 'compare', 'compareAttribute' => 'OT_INICIO', 'operator' => '>=', 'message' => 'La fecha de entrega no puede ser menor a la fecha de inicio'],
            [['OT_OBSERVACIONES'], 'string'],
            [['OT_OBSERVACIONES'], 'match', 'pattern' => '/^[\sa-zA-Z0-9áéíóúAÉÍÓÚÑñ.,:;-]+$/', 'message'=>'Por favor ingrese solo caracteres alfanuméricos y signos de puntuación.'],
            [['OD_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Despacho::className(), 'targetAttribute' => ['OD_ID' => 'OD_ID']],
            [['CBR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Cobros::className(), 'targetAttribute' => ['CBR_ID' => 'CBR_ID']],
            [['CLI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['CLI_ID' => 'CLI_ID']],
            [['VEH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Vehiculo::className(), 'targetAttribute' => ['VEH_ID' => 'VEH_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OT_ID' => 'Folio',
            'OD_ID' => 'Órden de Despacho',
            'CBR_ID' => 'Órden de Cobro',
            'VEH_ID' => 'Vehículo',
            'CLI_ID' => 'Cliente',
            'OT_INICIO' => 'Fecha Inicio',
            'OT_ENTREGA' => 'Fecha de Entrega',
            'OT_OBSERVACIONES' => 'Observaciones',
            'OT_ESTADO' => 'Estado',
            'OT_TDESABOLLADURA' => 'Total Desabolladura',
            'OT_TPINTURA' => 'Total Pintura',
            'OT_TINSUMO' => 'Total Insumos',
            'OT_TEXTERNO' => 'Total Servicios Externos',
            'OT_TREUTILIZADO' => 'Total Material Reutilizado',
            'OT_SUBTOTAL' => 'Subtotal',
            'OT_IVA' => 'IVA',
            'OT_TOTAL' => 'Total',
            'OT_TOTAL_HORAS' => 'Total Horas',
        ];
    }
    
    public function getUtilidad() 
    {
        return ($this->OT_TOTAL - ($this->OT_TINSUMO + $this->OT_TEXTERNO));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadDesabolladuras()
    {
        return $this->hasMany(ActividadDesabolladura::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadPinturas()
    {
        return $this->hasMany(ActividadPintura::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCobros()
    {
        return $this->hasMany(Cobros::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespachos()
    {
        return $this->hasMany(Despacho::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumo::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOD()
    {
        return $this->hasOne(Despacho::className(), ['OD_ID' => 'OD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCBR()
    {
        return $this->hasOne(Cobros::className(), ['CBR_ID' => 'CBR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLI()
    {
        return $this->hasOne(Cliente::className(), ['CLI_ID' => 'CLI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVEH()
    {
        return $this->hasOne(Vehiculo::className(), ['VEH_ID' => 'VEH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtrosServicios()
    {
        return $this->hasMany(OtrosServicios::className(), ['OT_ID' => 'OT_ID']);
    }
    
    public function getNombreVeh(){
        return $this->vEH->VEH_PATENTE;
    }
}
