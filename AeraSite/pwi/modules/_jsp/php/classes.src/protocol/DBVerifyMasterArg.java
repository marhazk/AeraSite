/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBVerifyMasterArg extends Rpc.Data
/*    */ {
/*    */   public Octets name;
/*    */   public Octets faction;
/*    */ 
/*    */   public DBVerifyMasterArg()
/*    */   {
/* 15 */     this.name = new Octets();
/* 16 */     this.faction = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.name);
/* 22 */     os.marshal(this.faction);
/* 23 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 28 */     os.unmarshal(this.name);
/* 29 */     os.unmarshal(this.faction);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 37 */       DBVerifyMasterArg o = (DBVerifyMasterArg)super.clone();
/* 38 */       o.name = ((Octets)this.name.clone());
/* 39 */       o.faction = ((Octets)this.faction.clone());
/* 40 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 43 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBVerifyMasterArg
 * JD-Core Version:    0.6.2
 */