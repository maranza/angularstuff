import { BrowserModule } from '@angular/platform-browser';
import {HttpModule} from '@angular/http';
import {HttpClient,HttpClientModule} from '@angular/common/http';
import {NgModule } from '@angular/core';
import {FormsModule} from '@angular/forms';
import {RouterModule,Routes} from '@angular/router';
import { AppComponent } from './app.component';
import { ContactComponent } from './contact/contact.component';
import { PatientComponent } from './patient/patient.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LoginComponent } from './login/login.component';
import { RegisterService } from './register.service';
import { ViewpatientComponent } from './viewpatient/viewpatient.component';
const routes: Routes = [
    {path:'*', redirectTo: '/dashboard', pathMatch: 'full'},
    {path: 'contact',component: ContactComponent},
    {path: 'dashboard',component: DashboardComponent},
    {path: 'patient' ,component: PatientComponent},
    {path:'view',component: ViewpatientComponent},
    {path: 'login',component: LoginComponent},
];

@NgModule({
  declarations: [
    AppComponent,
    ContactComponent,
    PatientComponent,
    DashboardComponent,
    LoginComponent,
    ViewpatientComponent
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(routes,{enableTracing: true}),
    FormsModule,
    HttpModule,
    HttpClientModule,
  ],
  providers: [RegisterService],
  bootstrap: [AppComponent]
})
export class AppModule { }
