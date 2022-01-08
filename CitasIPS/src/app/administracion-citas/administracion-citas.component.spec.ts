import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AdministracionCitasComponent } from './administracion-citas.component';

describe('AdministracionCitasComponent', () => {
  let component: AdministracionCitasComponent;
  let fixture: ComponentFixture<AdministracionCitasComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AdministracionCitasComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AdministracionCitasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
