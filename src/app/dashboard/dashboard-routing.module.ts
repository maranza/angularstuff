import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AddPatientComponent } from './components/add_patient/add_patient.component';
import { DashboardComponent } from './dashboard.component';
import { AdminComponent } from './components/admin/admin.component';
import { ViewpatientComponent } from './components/viewpatient/viewpatient.component';
import { ListPatientsComponent } from './components/list_patients/list_patients.component';
import { AuthGuard } from '../guards/auth.guard';
const dashBoardRoutes: Routes = [
  {
    path: '',
    component: AdminComponent,
    canActivate: [AuthGuard],
    children: [
      {
        path: '', component: DashboardComponent
      },
      { path: 'patient', component: AddPatientComponent },
      { path: 'view', component: ListPatientsComponent },
      { path: 'viewpatient/:uuid', component: ViewpatientComponent }
    ]

  },

];

@NgModule({
  imports: [
    RouterModule.forChild(dashBoardRoutes)
  ],
  exports: [
    RouterModule
  ]
})
export class DashBoardRoutingModule { }
