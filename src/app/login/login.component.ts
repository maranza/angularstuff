import { Component, OnInit } from '@angular/core';
import { Admin } from '../models/admin';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public error;

  public admin: Admin = new Admin();
  constructor(private authService: AuthService, private route: Router) {

    this.admin.username = '';

  }

  ngOnInit() {

  }

  login(): void {

    this.authService.authenticate(this.admin).subscribe(data => {
        if (data['success'] === true) {
          this.route.navigate(['/dashboard']);
          localStorage.setItem('username', this.admin.username);
        }
    },
    error => {

        this.error = error;

    });

  }

}
