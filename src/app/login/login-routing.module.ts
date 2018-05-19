import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent  }    from './login.component';

const dashBoardRoutes: Routes = [
  { path: '',  component: LoginComponent },
];

@NgModule({
  imports: [
    RouterModule.forChild(dashBoardRoutes)
  ],
  exports: [
    RouterModule
  ]
})
export class LoginRoutingModule { }