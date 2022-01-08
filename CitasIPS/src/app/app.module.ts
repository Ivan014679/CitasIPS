import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatIconModule } from '@angular/material/icon';
import { MatListModule } from '@angular/material/list';
import { MatButtonModule } from '@angular/material/button';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatMenuModule, MatMenuItem } from '@angular/material/menu';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatSelectModule } from '@angular/material/select';
import { MatInputModule } from '@angular/material/input';
import { MatDialogModule } from "@angular/material/dialog";
import { MatTooltipModule } from '@angular/material/tooltip'; 
import { DataTablesModule } from 'angular-datatables';
import { TableModule } from 'primeng/table';
import { ContextMenuModule } from 'primeng/contextmenu';
import { InputTextModule } from 'primeng/inputtext';
import { DropdownModule } from 'primeng/dropdown';
import { MultiSelectModule } from 'primeng/multiselect';
import { AppComponent } from './app.component';
import { HttpClientModule, HttpClient } from '@angular/common/Http';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PaginaPrincipalComponent } from './pagina-principal/pagina-principal.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { PacientesComponent } from './pacientes/pacientes.component';
import { RegistroCitasComponent } from './registro-citas/registro-citas.component';
import { AdministracionCitasComponent } from './administracion-citas/administracion-citas.component';
import { ReportesComponent } from './reportes/reportes.component';
import { CourseDialogComponent } from './course-dialog/course-dialog.component';
import { PersonalSaludComponent } from './personal-salud/personal-salud.component';

const appRoutes: Routes = [
  {
    path: '',
    component: PaginaPrincipalComponent,
    data: {
      title: 'Página principal'
    }
  },
  {
    path: 'pacientes',
    component: PacientesComponent,
    data: {
      title: 'Registro de pacientes'
    }
  },
  {
    path: 'regCitas',
    component: RegistroCitasComponent,
    data: {
      title: 'Registrar una cita'
    }
  },
  {
    path: 'regCitas/:id',
    component: RegistroCitasComponent,
    data: {
      title: 'Registrar una cita'
    }
  },
  {
    path: 'adminCitas',
    component: AdministracionCitasComponent,
    data: {
      title: 'Administrar citas'
    }
  },
  {
    path: 'reportes',
    component: ReportesComponent,
    data: {
      title: 'Reportes'
    }
  },
  {
    path: 'personalSalud',
    component: PersonalSaludComponent,
    data: {
      title: 'Agregar profesionales'
    }
  }
]

@NgModule({
  declarations: [
    AppComponent,
    PaginaPrincipalComponent,
    PacientesComponent,
    RegistroCitasComponent,
    AdministracionCitasComponent,
    ReportesComponent,
    CourseDialogComponent,
    PersonalSaludComponent    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    MatToolbarModule,
    MatSidenavModule,
    MatListModule,
    MatButtonModule,
    MatIconModule,
    MatExpansionModule,
    MatMenuModule,
    MatFormFieldModule,
    MatSelectModule,
    MatInputModule,
    MatDialogModule,
    MatTooltipModule,
    DataTablesModule,
    TableModule,
    ContextMenuModule,
    InputTextModule,
    DropdownModule,
    MultiSelectModule,
    HttpClientModule,
    RouterModule.forRoot(appRoutes),
    FormsModule,
    ReactiveFormsModule,
    BrowserAnimationsModule
  ],
  providers: [],
  bootstrap: [AppComponent],
  entryComponents: [CourseDialogComponent]
})
export class AppModule { }
