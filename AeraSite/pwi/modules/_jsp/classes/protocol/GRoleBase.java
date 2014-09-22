/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GRoleBase extends Rpc.Data
/*    */ {
/*    */   public byte version;
/*    */   public int id;
/*    */   public Octets name;
/*    */   public int race;
/*    */   public int cls;
/*    */   public byte gender;
/*    */   public Octets custom_data;
/*    */   public Octets config_data;
/*    */   public int custom_stamp;
/*    */   public byte status;
/*    */   public int delete_time;
/*    */   public int create_time;
/*    */   public int lastlogin_time;
/*    */   public Rpc.Data.DataVector forbid;
/*    */   public Octets help_states;
/*    */   public int spouse;
/*    */   public int userid;
/*    */   public int reserved1;
/*    */ 
/*    */   public GRoleBase()
/*    */   {
/* 31 */     this.name = new Octets();
/* 32 */     this.custom_data = new Octets();
/* 33 */     this.config_data = new Octets();
/* 34 */     this.forbid = new Rpc.Data.DataVector(new GRoleForbid());
/* 35 */     this.help_states = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 40 */     os.marshal(this.version);
/* 41 */     os.marshal(this.id);
/* 42 */     os.marshal(this.name);
/* 43 */     os.marshal(this.race);
/* 44 */     os.marshal(this.cls);
/* 45 */     os.marshal(this.gender);
/* 46 */     os.marshal(this.custom_data);
/* 47 */     os.marshal(this.config_data);
/* 48 */     os.marshal(this.custom_stamp);
/* 49 */     os.marshal(this.status);
/* 50 */     os.marshal(this.delete_time);
/* 51 */     os.marshal(this.create_time);
/* 52 */     os.marshal(this.lastlogin_time);
/* 53 */     os.marshal(this.forbid);
/* 54 */     os.marshal(this.help_states);
/* 55 */     os.marshal(this.spouse);
/* 56 */     os.marshal(this.userid);
/* 57 */     os.marshal(this.reserved1);
/* 58 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 63 */     this.version = os.unmarshal_byte();
/* 64 */     this.id = os.unmarshal_int();
/* 65 */     os.unmarshal(this.name);
/* 66 */     this.race = os.unmarshal_int();
/* 67 */     this.cls = os.unmarshal_int();
/* 68 */     this.gender = os.unmarshal_byte();
/* 69 */     os.unmarshal(this.custom_data);
/* 70 */     os.unmarshal(this.config_data);
/* 71 */     this.custom_stamp = os.unmarshal_int();
/* 72 */     this.status = os.unmarshal_byte();
/* 73 */     this.delete_time = os.unmarshal_int();
/* 74 */     this.create_time = os.unmarshal_int();
/* 75 */     this.lastlogin_time = os.unmarshal_int();
/* 76 */     os.unmarshal(this.forbid);
/* 77 */     os.unmarshal(this.help_states);
/* 78 */     this.spouse = os.unmarshal_int();
/* 79 */     this.userid = os.unmarshal_int();
/* 80 */     this.reserved1 = os.unmarshal_int();
/* 81 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 88 */       GRoleBase o = (GRoleBase)super.clone();
/* 89 */       o.name = ((Octets)this.name.clone());
/* 90 */       o.custom_data = ((Octets)this.custom_data.clone());
/* 91 */       o.config_data = ((Octets)this.config_data.clone());
/* 92 */       o.forbid = ((Rpc.Data.DataVector)this.forbid.clone());
/* 93 */       o.help_states = ((Octets)this.help_states.clone());
/* 94 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 97 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleBase
 * JD-Core Version:    0.6.2
 */