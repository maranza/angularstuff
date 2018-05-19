import { NgModule }       from '@angular/core';
import { CommonModule }   from '@angular/common';
import { FormsModule }    from '@angular/forms';
import { DashBoardRoutingModule } from './dashboard-routing.module';
import { NavbarComponent } from '../components/navbar/navbar.component'; 
import { DashboardComponent  }    from './dashboard.component';
import { AddPatientComponent } from '../components/add_patient/add_patient.component';
import { ListPatientsComponent } from '../components/list_patients/list_patients.component';
import { AuthService } from '../services/auth.service';
import {PatientService} from '../services/patient.service';
import { AdminComponent } from './admin/admin.component'

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    DashBoardRoutingModule
  ],
  declarations: [
    NavbarComponent,
    DashboardComponent,
    AdminComponent,
    AddPatientComponent,
    ListPatientsComponent
  ],
  providers: [ AuthService ,PatientService]
})
export class DashBoardModule {}