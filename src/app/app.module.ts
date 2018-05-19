import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes, CanActivate } from '@angular/router';
import { httpInterceptorProviders } from './interceptors';
import { AppComponent } from './app.component';
import { AuthService } from './services/auth.service';
import { AuthGuard } from './guards/auth.guard';
import { LoginModule } from './login/login.module';
import { DashBoardModule } from './dashboard/dashboard.module';
const routes: Routes = [ 
  { path: 'login', loadChildren: 'app/login/login.module#LoginModule' },
  { path: 'dashboard', loadChildren: 'app/dashboard/dashboard.module#DashBoardModule',canActivate:[AuthGuard] },
  { path: '', redirectTo: 'dashboard', pathMatch: 'full' }
];

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(routes, { enableTracing: true ,useHash: true}),
    FormsModule,
    HttpModule,
    HttpClientModule,
  ],
  providers: [AuthService, AuthGuard,httpInterceptorProviders],
  bootstrap: [AppComponent]
})
export class AppModule { }
