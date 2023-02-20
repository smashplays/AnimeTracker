import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AnimeSearchComponent } from './anime-search/anime-search.component';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from '../app-routing.module';
import { FooterComponent } from './footer/footer.component';



@NgModule({
  declarations: [
    AnimeSearchComponent,
    FooterComponent
  ],
  exports: [
    AnimeSearchComponent,
    FooterComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    AppRoutingModule
  ]
})
export class SharedModule { }
