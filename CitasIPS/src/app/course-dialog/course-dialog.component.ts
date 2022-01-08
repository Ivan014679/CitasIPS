import { Component, OnInit, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from "@angular/material/dialog";
import { ActivatedRoute, Router, ParamMap } from '@angular/router';

@Component({
  selector: 'app-course-dialog',
  templateUrl: './course-dialog.component.html',
  styleUrls: ['./course-dialog.component.css']
})
export class CourseDialogComponent implements OnInit {
  titulo: string;
  mensaje: string;
  tipo: number;
  boton1: string;
  boton2: string;

  constructor(private dialogRef: MatDialogRef<CourseDialogComponent>,
    private route: ActivatedRoute,
    private router: Router,
    @Inject(MAT_DIALOG_DATA) data) {
    this.titulo = data.titulo;
    this.mensaje = data.mensaje;
    this.tipo = data.tipo;
    this.boton1 = data.boton1;
    this.boton2 = data.boton2;
  }

  ngOnInit() {

  }

  afirmacion() {
    if(this.tipo == 0){
      this.dialogRef.close(true);
    }else if(this.tipo > 0){
      this.router.navigate(['/regCitas/', this.tipo]);
      this.dialogRef.close();
    }
  }

  negacion() {
    this.dialogRef.close();
  }
}
