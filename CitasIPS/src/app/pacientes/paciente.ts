export interface Paciente {
    id: number;
    identificacion: string;
    tipo_identificacion: number;
    expedicion: string;
    codigo: string;
    nombres: string;
    apellidos: string;
    genero: string;
    fecha_nacimiento: string;
    telefono: string;
    celular: string;
    correo_electronico: string;
    direccion: string;
    barrio: string;
    estrato: number;
    programa: string;
    semestre: string;
    eps: string;
    modalidad_afiliacion: string;
    id_estudiante: number;
}