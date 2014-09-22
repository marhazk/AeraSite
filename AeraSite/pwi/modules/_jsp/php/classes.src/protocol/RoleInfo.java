/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Marshal.MarshalException;
/*     */ import com.goldhuman.Common.Marshal.OctetsStream;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*     */ 
/*     */ public final class RoleInfo extends Rpc.Data
/*     */ {
/*     */   public int roleid;
/*     */   public byte gender;
/*     */   public byte race;
/*     */   public byte occupation;
/*     */   public int level;
/*     */   public int level2;
/*     */   public Octets name;
/*     */   public Octets custom_data;
/*     */   public Rpc.Data.DataVector equipment;
/*     */   public byte status;
/*     */   public int delete_time;
/*     */   public int create_time;
/*     */   public int lastlogin_time;
/*     */   public float posx;
/*     */   public float posy;
/*     */   public float posz;
/*     */   public int worldtag;
/*     */   public Octets custom_status;
/*     */   public Octets charactermode;
/*     */   public int referrer_role;
/*     */   public int cash_add;
/*     */ 
/*     */   public RoleInfo()
/*     */   {
/*  34 */     this.name = new Octets();
/*  35 */     this.custom_data = new Octets();
/*  36 */     this.equipment = new Rpc.Data.DataVector(new GRoleInventory());
/*  37 */     this.custom_status = new Octets();
/*  38 */     this.charactermode = new Octets();
/*     */   }
/*     */ 
/*     */   public OctetsStream marshal(OctetsStream os)
/*     */   {
/*  43 */     os.marshal(this.roleid);
/*  44 */     os.marshal(this.gender);
/*  45 */     os.marshal(this.race);
/*  46 */     os.marshal(this.occupation);
/*  47 */     os.marshal(this.level);
/*  48 */     os.marshal(this.level2);
/*  49 */     os.marshal(this.name);
/*  50 */     os.marshal(this.custom_data);
/*  51 */     os.marshal(this.equipment);
/*  52 */     os.marshal(this.status);
/*  53 */     os.marshal(this.delete_time);
/*  54 */     os.marshal(this.create_time);
/*  55 */     os.marshal(this.lastlogin_time);
/*  56 */     os.marshal(this.posx);
/*  57 */     os.marshal(this.posy);
/*  58 */     os.marshal(this.posz);
/*  59 */     os.marshal(this.worldtag);
/*  60 */     os.marshal(this.custom_status);
/*  61 */     os.marshal(this.charactermode);
/*  62 */     os.marshal(this.referrer_role);
/*  63 */     os.marshal(this.cash_add);
/*  64 */     return os;
/*     */   }
/*     */ 
/*     */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*     */   {
/*  69 */     this.roleid = os.unmarshal_int();
/*  70 */     this.gender = os.unmarshal_byte();
/*  71 */     this.race = os.unmarshal_byte();
/*  72 */     this.occupation = os.unmarshal_byte();
/*  73 */     this.level = os.unmarshal_int();
/*  74 */     this.level2 = os.unmarshal_int();
/*  75 */     os.unmarshal(this.name);
/*  76 */     os.unmarshal(this.custom_data);
/*  77 */     os.unmarshal(this.equipment);
/*  78 */     this.status = os.unmarshal_byte();
/*  79 */     this.delete_time = os.unmarshal_int();
/*  80 */     this.create_time = os.unmarshal_int();
/*  81 */     this.lastlogin_time = os.unmarshal_int();
/*  82 */     this.posx = os.unmarshal_float();
/*  83 */     this.posy = os.unmarshal_float();
/*  84 */     this.posz = os.unmarshal_float();
/*  85 */     this.worldtag = os.unmarshal_int();
/*  86 */     os.unmarshal(this.custom_status);
/*  87 */     os.unmarshal(this.charactermode);
/*  88 */     this.referrer_role = os.unmarshal_int();
/*  89 */     this.cash_add = os.unmarshal_int();
/*  90 */     return os;
/*     */   }
/*     */ 
/*     */   public Object clone()
/*     */   {
/*     */     try
/*     */     {
/*  97 */       RoleInfo o = (RoleInfo)super.clone();
/*  98 */       o.name = ((Octets)this.name.clone());
/*  99 */       o.custom_data = ((Octets)this.custom_data.clone());
/* 100 */       o.equipment = ((Rpc.Data.DataVector)this.equipment.clone());
/* 101 */       o.custom_status = ((Octets)this.custom_status.clone());
/* 102 */       o.charactermode = ((Octets)this.charactermode.clone());
/* 103 */       return o;
/*     */     } catch (Exception e) {
/*     */     }
/* 106 */     return null;
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RoleInfo
 * JD-Core Version:    0.6.2
 */