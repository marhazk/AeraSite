/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBDeleteRoleRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public int userid;
/*    */   public int rolelist;
/*    */   public int faction;
/*    */   public Octets rolename;
/*    */ 
/*    */   public DBDeleteRoleRes()
/*    */   {
/* 18 */     this.rolename = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 23 */     os.marshal(this.retcode);
/* 24 */     os.marshal(this.userid);
/* 25 */     os.marshal(this.rolelist);
/* 26 */     os.marshal(this.faction);
/* 27 */     os.marshal(this.rolename);
/* 28 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 33 */     this.retcode = os.unmarshal_int();
/* 34 */     this.userid = os.unmarshal_int();
/* 35 */     this.rolelist = os.unmarshal_int();
/* 36 */     this.faction = os.unmarshal_int();
/* 37 */     os.unmarshal(this.rolename);
/* 38 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 45 */       DBDeleteRoleRes o = (DBDeleteRoleRes)super.clone();
/* 46 */       o.rolename = ((Octets)this.rolename.clone());
/* 47 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 50 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBDeleteRoleRes
 * JD-Core Version:    0.6.2
 */