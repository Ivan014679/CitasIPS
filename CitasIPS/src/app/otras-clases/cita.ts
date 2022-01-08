export interface Cita {
    id: number;
    id_paciente: number;
    identificacion: string;
    tipo_identificacion: string;
    codigo: string;
    acudiente: string;
    parentezco: number;
    fecha_cita: string;
    hora_cita: string;
    estado_seguimiento: number;
    n_estado_seguimiento: string;
    servicio_aplicado: number;
    n_servicio_aplicado: string;
    personal_salud: number;
    nombre_personal_salud: string;
    tipo_personal_salud: number;
    servicio_complementario: number;
    observaciones: string;
    id_periodo_academico: number;
}